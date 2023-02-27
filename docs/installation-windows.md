# Run docker-compose.yml
1. Running command docker compose to build and up container and configs from phpmyadmin, mysql and wordpress
```
docker compose -f "docker-compose.yml" up -d --build 
```

# Create virtualhost on windows
1. Inside directory <b>`C:\Windows\System32\drivers\etc`</b> add at end of line:
```
127.0.0.1 your-domain.test
```

# Create database and add permission on user
1. Access phpmyadmin with 
```
Address: http://your-domain.test:8080<br>
Username: root <br>
Password:  <br>
```

password is empty

2. Insert the query sql
```
CREATE DATABASE name_project DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
```

# Install tables on database created
1. Install the file <b>`install.sql`</b> in the created database that is inside the docs folder

2. Insert the query sql
```
UPDATE wp_posts SET guid = REPLACE(guid,'http://your-domain.test','http://CHANGE-DOMAIN.test') WHERE guid LIKE '%http://your-domain.test%';
UPDATE wp_posts SET post_content = REPLACE(post_content,'http://your-domain.test','http://CHANGE-DOMAIN.test') WHERE post_content LIKE '%http://your-domain.test%';
UPDATE wp_options SET option_value = REPLACE(option_value,'http://your-domain.test','http://CHANGE-DOMAIN.test') WHERE option_value LIKE '%http://your-domain.test%';
UPDATE wp_users SET user_url = REPLACE(user_url,'http://your-domain.test','http://CHANGE-DOMAIN.test') WHERE user_url LIKE '%http://your-domain.test%';
```

# Configure wp-config inside folder wp
change the code:

```
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress') );
/** Database username */
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username') );
/** Database password */
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password') );
/** Database hostname */
define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql') );
```

to:
```
/** The name of the database for WordPress */
define( 'DB_NAME', 'name_project');
/** Database username */
define( 'DB_USER', 'root');
/** Database password */
define( 'DB_PASSWORD', '');
/** Database hostname */
define( 'DB_HOST', 'db');
```

# Access painel admin
Address: http://your-domain.test/wp-login.php <br>
Username: admin <br>
Password: admin <br>