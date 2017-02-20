import {Component, Input, OnInit} from '@angular/core';
import {ActivatedRoute, Params}   from '@angular/router';
import {Location}                 from '@angular/common';
import {PersonService} from '../services/person.service'
import {Person} from '../models/person';
import 'rxjs/add/operator/switchMap';

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

export class PersonDetailsComponent implements OnInit {
  ngOnInit(): void {
    this.route.params
      .switchMap((params: Params) =>
      this.personService.getPerson(+params['id'])
      )
      .subscribe(hero => this.hero = hero);
  }
  @Input() hero: Person;

  constructor(
    private personService: PersonService,
    private route: ActivatedRoute,
    private location: Location) {
  }
}
