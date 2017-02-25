import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params}   from '@angular/router';
import {Person}                 from '../models/person';
import {PersonService} from '../services/person.service'
import 'rxjs/add/operator/switchMap';

@Component({
  moduleId: module.id,
  selector: 'bad-guys',
  templateUrl: '../templates/persons.component.html',
  styleUrls: ['../styles/persons.component.css']
})

export class PersonsComponent implements OnInit {
  ngOnInit(): void {
    this.route.params
      .switchMap((params: Params) => this.getPersons(params['personsType']))
      .subscribe(personsType => this.personsType = personsType);
  }

  persons: Person[];

  wrongPersonMessage = "Wrong person's type."
  personsType: string;

  constructor(private personService: PersonService,
  private route: ActivatedRoute) {
  }

  getPersons(personsType: string): string {
    if(personsType == 'heroes') {
      this.personService.getHeroes().then(heroes => this.persons = heroes);
      return personsType;
    }
    else if(personsType == 'bad_guys') {
      this.personService.getBadGuys().then(badGuys => this.persons = badGuys);
      return personsType;
    }
    this.persons = [];
    return ' ';
  }
}
