pipeline {
    agent any

    stages {
        stage('Build Docker Image') {
            steps {
                sh "docker build -t valentinelices/fatboar:1.0.0 . --build-arg user=test --build-arg uid=1000 --no-cache"
            }
        }
        stage('SonarQube analysis') {
            def scannerHome = tool 'sonarqube';
            withSonarQubeEnv('sonarqube') {
            sh "${scannerHome}/bin/sonar-scanner \
            -sonar-scanner \
            -Dsonar.projectKey=fatboar \
            -Dsonar.sources=. \
            -Dsonar.host.url=http://91.230.111.25:9000 \
            -Dsonar.login=a8a07dfc5c7fb1e148e12cfba1a2b822b3bdd590"
            }
        }






    }
}