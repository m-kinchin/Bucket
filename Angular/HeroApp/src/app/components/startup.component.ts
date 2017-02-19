import {Component} from '@angular/core';

@Component({
  selector: 'startup',
  template: `
  <h1>{{title}}</h1>
  <nav>
    <a routerLink="/dashboard">Dashboard</a>
    <a routerLink="/heroes">Heroes</a>
    <a routerLink="/bad_guys">Bad guys</a>
  </nav>
  <router-outlet></router-outlet>
`
})

export class StartupComponent {
  title = 'Tour of Heroes';
}
