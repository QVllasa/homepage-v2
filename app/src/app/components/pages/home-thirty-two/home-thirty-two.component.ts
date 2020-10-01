import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home-thirty-two',
  templateUrl: './home-thirty-two.component.html',
  styleUrls: ['./home-thirty-two.component.scss']
})
export class HomeThirtyTwoComponent implements OnInit {

    icons = [
        'assets/img/stack-icons/angular-icon.svg',
        'assets/img/stack-icons/azure.svg',
        'assets/img/stack-icons/docker.svg',
        'assets/img/stack-icons/git.svg',
        'assets/img/stack-icons/html5.svg',
        'assets/img/stack-icons/mysql.svg',
        'assets/img/stack-icons/nodejs.svg',
        'assets/img/stack-icons/php.svg',
        'assets/img/stack-icons/postgresql.svg',
        'assets/img/stack-icons/python.svg',
        'assets/img/stack-icons/sass.svg',
        'assets/img/stack-icons/symfony.svg',
        'assets/img/stack-icons/tailwindcss.svg',
        'assets/img/stack-icons/typescript.svg',
        'assets/img/stack-icons/graphql.svg',
        'assets/img/stack-icons/adobe-xd.svg',
        'assets/img/stack-icons/phpstorm.svg',
        'assets/img/stack-icons/javascript.svg',

    ]

  constructor() { }

  ngOnInit(): void {
  }



}
