
pipeline {
    agent any

    environment {
        CI='true'
        NODE_ENV='test'
        MARIADB_PASSWORD='Cc3ed23c'
        MARIADB_USER='tecadmin'
        MARIADB_DB='mariadb'
        PROJECT_NAME='fatboar'
        
    }
    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                sh "docker-compose build --no-cache"
                sh "docker-compose up -d"
            }
        }
    }
}