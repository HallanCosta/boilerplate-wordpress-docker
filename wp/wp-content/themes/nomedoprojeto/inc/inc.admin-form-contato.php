<?php

if ( !function_exists('contato') )
{
    function contato()
    {
        global $wpdb, $destinatarios;

        $debug = [
            'proc' => 'c_' . formatDateTime('now', 'Y-m-d_H-i-s') . '.log', // FIX: timezone
            '_REQUEST' => $_REQUEST,
            '_FILES' => $_FILES,
        ];

        $out = [
            'code' => 0,
            'message' => '',
        ];

        $nome = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
        $email = isset($_REQUEST['email']) ? trim($_REQUEST["email"]) : '';
        // $telefone = isset($_REQUEST['phone']) ? trim($_REQUEST["phone"]) : '';
        // $departamento = isset($_REQUEST['departamento']) ? trim($_REQUEST["departamento"]) : '';
        $mensagem = isset($_REQUEST['message']) ? trim(
            nl2br(
                esc_html(
                    strip_tags(
                        trim(
                            $_REQUEST["message"]
                        )
                    )
                )
            )
        ) : '';

        if (
            !checkNome($nome, 3, 64) ||
            !checkEmail($email) ||
            // !checkBoth($telefone) ||
            !check_length($mensagem, 8, 2048)
        )
        {
            $debug['step'] = 2;
            $out['message'] = '<b>A solicitação não foi processada</b><br><br>Por favor, tente novamente e se o erro persistir, entre em contato conosco.';
        }
        else
        {
            /* data */
            $datetime = formatDateTime('now', 'Y-m-d H:i:s');
            $datetime_fmt = date('d/m/Y H:i', strtotime($datetime));

            // Escreve a solicitação no banco de dados

            $post_id = wp_insert_post([
                'post_status'   => 'publish',
                'post_type'     => 'contato',
                'post_title'    => $nome
            ]);

            update_field('email', $email, $post_id);
            // update_field('telefone', $telefone, $post_id);
            // update_field('telefone', $telefone, $post_id);
            update_field('mensagem', trim(strip_tags($mensagem)), $post_id);

            // Notifica administradores por e-mail (Se o setor estiver configurado)

            $msg = <<<HEREDOC
<tr>
<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
<br>
<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#db9724;">Chegou uma mensagem atrav&eacute;s do site SuperGols!</div>
<br>
<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:13px;line-height:20px;text-align:left;color:#144f99">
<b>Data:</b><br>{$datetime_fmt}
<br><br><b>Nome:</b><br>{$nome}
<br><br><b>E-mail:</b><br>{$email}
<br><br><b>Mensagem:</b><br>{$mensagem}
HEREDOC;

            $send_status = 0;

            $msg = formatEmail($msg);

            add_filter('wp_mail_content_type', 'wpdocs_set_html_mail_content_type');
            $send_status = wp_mail(
                $destinatarios['contato'],
                'Contato – Site Super Gols',
                $msg
            );
            remove_filter('wp_mail_content_type', 'wpdocs_set_html_mail_content_type');

            $debug["send_email_contato"] = (int)$send_status;

            // Saída

            $debug['step'] = 3;
            $out["code"] = 1;
            $out["title"] = "Mensagem enviada com sucesso!";
            $out["message"] = "Em breve nós entraremos em contato";
            $out["debug"] = $destinatarios['contato'];
        }

        // Retgorno (sucesso ou não)

        $debug['output'] = $out;
        saveFile( 'formularios/contato', $debug );

        wp_die( json_encode($out) );
    }
}

add_action('wp_ajax_contato', 'contato');
add_action('wp_ajax_nopriv_contato', 'contato');