import {Component, Input, OnInit} from '@angular/core';
import {ActivatedRoute, Params}   from '@angular/router';
import {Location}                 from '@angular/common';
import {PersonService}            from '../services/person.service'
import {Person}                   from '../models/person';
import 'rxjs/add/operator/switchMap';

@Component({
  moduleId: module.id,
  selector: 'person-details',
  templateUrl: '../templates/person-detail.component.html',
})

export class PersonDetailsComponent implements OnInit {
  ngOnInit(): void {
    this.route.params
      .switchMap((params: Params) => this.personService.getPerson(+params['id']))
      .subscribe(person => this.person = person);
  }
  goBack(): void {
    this.location.back();
  }
  @Input() person: Person;

  constructor(private personService: PersonService,
              private route: ActivatedRoute,
              private location: Location) {
  }
}
