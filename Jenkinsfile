pipeline {
    agent any

    stages {
        stage('Build Docker Image') {
            steps {
                sh "docker build -t valentinelices/fatboar:1.0.0 . --build-arg user=test --build-arg uid=1000 --no-cache"
            }
        }
     
    }
    }
