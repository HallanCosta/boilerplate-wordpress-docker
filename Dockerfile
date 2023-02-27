FROM wordpress

# Add correct perimission on directories from container
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html