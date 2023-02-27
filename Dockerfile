FROM wordpress

# Add correct perimission on directories from container
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Remove themes defaults
RUN rm -rf /var/www/html/wp-content/themes/twentytwentyone
RUN rm -rf /var/www/html/wp-content/themes/twentytwentytwo
RUN rm -rf /var/www/html/wp-content/themes/twentytwentythree