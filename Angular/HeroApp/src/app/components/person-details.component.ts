import {Component, Input} from '@angular/core';
import {Person} from '../models/person';

@Component({
  selector: 'person-details',
  template: `
  <div *ngIf="hero && hero.id % 2 == 0">
    <h2>{{hero.name}} details!</h2>
    <div><label>id: </label>{{hero.id}}</div>
    <div>
        <label>name: </label>
        <input [(ngModel)]="hero.name" placeholder="name"/>
    </div>
  </div>
  <div *ngIf="hero && hero.id % 2 != 0">
    <h2>{{hero.name}} details!</h2>
    <div><label>id: </label>{{hero.id}}</div>
    <div>
        <label>name: </label> {{hero.name}}
    </div>
  </div>
  `
})

export class PersonDetailsComponent {
  @Input()
  hero: Person
}
