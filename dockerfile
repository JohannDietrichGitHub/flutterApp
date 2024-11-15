# Dockerfile - Flutter
FROM instrumentisto/flutter:latest

ENV DEBIAN_FRONTEND=noninteractive

# Installer des outils supplémentaires si nécessaire
RUN apt-get update && apt-get install -y \
    curl \
    git \
    vim \
    php-cli \
    php-mysql \
    xvfb \
    libcanberra-gtk-module \
    libcanberra-gtk3-module \
    libatk-adaptor \
    at-spi2-core \
    && apt-get clean
    
# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers du projet dans le container
COPY . /app

# Commande par défaut (à adapter selon tes besoins)
CMD ["bash"]