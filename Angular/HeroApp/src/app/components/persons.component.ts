import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params, Router}   from '@angular/router';
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
  wrongPersonMessage = "Wrong person's type.";
  persons: Person[];
  personsType: string;
  selectedPerson: Person;

  constructor(private personService: PersonService,
              private route: ActivatedRoute,
              private router: Router) {
  }

  ngOnInit(): void {
    this.route.params
      .switchMap((params: Params) => Promise.resolve(this.getPersons(params['personsType'])))
      .subscribe(personsType => this.personsType = personsType);
  }

  onSelect(person: Person): void {
    this.selectedPerson = person;
  };

  getPersons(personsType: string): string {
    if (personsType == 'heroes') {
      this.personService.getHeroes().then(heroes => this.persons = heroes);
      return personsType;
    }
    else if (personsType == 'bad_guys') {
      this.personService.getBadGuys().then(badGuys => this.persons = badGuys);
      return personsType;
    }
    this.persons = [];
    return ' ';
  }

  gotoDetail(): void {
    this.router.navigate(['/detail', this.selectedPerson.id]);
  }
}
