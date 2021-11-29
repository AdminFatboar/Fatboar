pipeline {
   agent any
  stages {
   stage ('PHPUNIT'){
       agent {
           dockerfile "easyengine/php7.4"
       }
           steps{
               script{
               sh 'chmod -R 777 $WORKSPACE/vendor/bin/phpunit'
               sh "php -v"
               
           }
       }
   }
   
  }
}
