FROM ubuntu:16.04
MAINTAINER Danny van der Sluijs <danny.vandersluijs@icloud.com>

RUN apt-get update && apt-get install -y \
	nginx

COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]