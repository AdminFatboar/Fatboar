
pipeline {
    agent any

    environment {
        NODE_ENV='test'
    }
    stages {
        stage('Build') {
            steps {
               cd "/tmp/fatboar-build-docker-image"
                sh "docker-compose build"
                sh "docker-compose up -d"
          }
        }
    }
}