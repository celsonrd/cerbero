FROM php:7.2-apache
RUN apt update && apt upgrade -y && apt install locales locales-all -y
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN echo "pt_BR.UTF-8" >> /etc/locale.gen


# ENV LANG=pt_BR.UTF-8
# ENV LC_CTYPE="pt_BR.UTF-8"
# ENV LC_NUMERIC=pt_BR.UTF-8
# ENV LC_TIME="pt_BR.UTF-8"
# ENV LC_COLLATE="pt_BR.UTF-8"
# ENV LC_MONETARY=pt_BR.UTF-8
# ENV LC_MESSAGES="pt_BR.UTF-8"
# ENV LC_PAPER=pt_BR.UTF-8
# ENV LC_NAME=pt_BR.UTF-8
# ENV LC_ADDRESS=pt_BR.UTF-8
# ENV LC_TELEPHONE=pt_BR.UTF-8
# ENV LC_MEASUREMENT=pt_BR.UTF-8
# ENV LC_IDENTIFICATION=pt_BR.UTF-8
#ENV LC_ALL pt_BR.UTF-8
#ENV LC_ALL=
