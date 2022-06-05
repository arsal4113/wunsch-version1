FROM gcr.io/google-appengine/php:latest
ENV DOCUMENT_ROOT /app/webroot

#RUN sed -i "s/worker_processes  auto/worker_processes $(grep "NGINX_WORKER_COUNT" app.yaml | awk '{ print $2 }')/g" /etc/nginx/nginx.conf

### WORKAROUND FOR BUGGY PHP 7.2 CURL DUE TO UBUNTU USING BROKEN LIBTLS INSTEAD OF WORKING OPENSSL ###

# example problem: "cURL Error (56) GnuTLS recv error (-110): The TLS connection was non-properly terminated."
# required for working google login, see JIRA WD-2062
# we have to replace the whole google php runtime environment with one using openssl instead of libtls
# we just want to replace the curl extension but its statically build into google php

# keep google php package from updating, we are overwriting it
######RUN apt-mark hold gcp-php72

# enabling deb-src links to be able to get all php build dependencies
#######RUN sed -i 's/# deb-src/deb-src/g' /etc/apt/sources.list

# adding ondrej ppa (trustworthy person: maintainer of debian php packages) for php 7.2 deb-src and libsodium23
#######RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php -s -y

# fetching data from new deb-src links
#######RUN apt update

# installing dependencies for new php runtime environment
######RUN apt install openssl libcurl3 libsodium23 -y

# getting build dependencies for php 7.2
########RUN apt install equivs devscripts libreadline-dev -y --no-install-recommends
#########RUN yes | mk-build-deps php7.2 --install --remove

# getting php 7.2 source from official debian php repository, also base for ubuntu packages
#########RUN cd ~ && git clone https://salsa.debian.org/php-team/php.git -b debian/main/7.2

# configure parameters based on php -i | grep "Configure Command" to get as close as possible to google php build
##########RUN cd ~/php && ./configure --build=x86_64-linux-gnu --includedir=/opt/php72/include --mandir=/opt/php72/share/man --infodir=/opt/php72/share/info --sysconfdir=/etc --localstatedir=/var --libdir=/opt/php72/lib/x86_64-linux-gnu --libexecdir=/opt/php72/lib/x86_64-linux-gnu --prefix=/opt/php72 --with-sodium --with-config-file-path=/opt/php72/lib --with-config-file-scan-dir=/opt/php72/lib/ext.enabled:/opt/php72/lib/conf.d --enable-sysvsem --enable-sysvshm --enable-sysvmsg --disable-cgi --enable-bcmath=shared --enable-calendar=shared --enable-exif=shared --enable-fpm --enable-ftp=shared --enable-intl=shared --enable-mbstring --enable-mysqlnd --enable-opcache-file --enable-pcntl --enable-shared --enable-shmop=shared --enable-soap=shared --enable-sockets --enable-zip --with-bz2 --with-curl --with-gettext=shared --with-gd=shared --with-gmp --with-freetype-dir=/usr --with-jpeg-dir=/usr --with-pdo_sqlite=shared,/usr --with-pdo-pgsql --with-pgsql --with-sqlite3=shared,/usr --with-xmlrpc=shared --with-xsl=shared --with-fpm-user=www-data --with-fpm-group=www-data --with-mysqli=mysqlnd --with-pdo-mysql=mysqlnd --with-openssl --with-pcre-regex --with-readline --with-recode --with-zlib build_alias=x86_64-linux-gnu

# start building php, get one or two cups of coffee or a tea, this will take some time
##########RUN cd ~/php && make && make install

# clean up, removing source files and build dependencies
#############RUN rm -rf ~/php; apt remove libreadline-dev php7.2-build-deps devscripts equivs -y; apt autoremove -y

# killing running php-fpm processes, preinstalled supervisord from google docker image should immediately restart them
###########RUN killall php-fpm; true



### WORKAROUND END ###

RUN composer run-script post-install-cmd
