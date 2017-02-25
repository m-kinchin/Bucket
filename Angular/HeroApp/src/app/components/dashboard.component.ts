import {Component, OnInit}  from '@angular/core';
import {Person}             from '../models/person';
import {PersonService}      from '../services/person.service';

@Component({
  moduleId: module.id,
  selector: 'dashboard',
  templateUrl: '../templates/dashboard.component.html',
})

export class DashboardComponent implements OnInit {
  ngOnInit(): void {
    this.personService.getHeroes().then(heroes => this.heroes = heroes.slice(1, 5));
    this.personService.getBadGuys().then(badGuys => this.badGuys = badGuys.slice(1, 5));
  }

  heroes: Person[] = [];
  badGuys: Person[] = [];

  constructor(private personService: PersonService) {
  }
}
