pipeline {
    agent {
        docker {
            image 'markhobson/maven-chrome'
        }
    }
    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/rimshaa2/taskmanager.git'
            }
        }
        stage('Run Tests') {
            steps {
                sh 'python3 test_taskmanager.py'
            }
        }
    }
}
