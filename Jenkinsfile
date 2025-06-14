pipeline {
  agent any

  stages {
    stage('Checkout') {
      steps {
        git 'https://github.com/rimshaa2/TaskManager.git'
      }
    }

    stage('Run Selenium Tests') {
      steps {
        dir('tests') {
          script {
            docker.image('markhobson/maven-chrome').inside {
              sh 'mvn test'
            }
          }
        }
      }
    }
  }
}

