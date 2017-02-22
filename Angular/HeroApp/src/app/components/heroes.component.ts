import {Component, Input}       from '@angular/core';
import {OnInit}                 from '@angular/core';
import {Person}                 from '../models/person';
import {PersonDetailsComponent} from './person-details.component';
import {PersonService}          from '../services/person.service';

@Component({
  moduleId: module.id,
  selector: 'heroes',
  templateUrl: '../templates/persons.component.html',
  styles: [`
  .selected-odd {
    background-color: #CFD8DC !important;
    color: white;
  }
  .selected-even {
    background-color: #f45239 !important;
    color: white;
  }
  .heroes {
    margin: 0 0 2em 0;
    list-style-type: none;
    padding: 0;
    width: 15em;
  }
  .heroes li {
    cursor: pointer;
    position: relative;
    left: 0;
    background-color: #EEE;
    margin: .5em;
    padding: .3em 0;
    height: 1.6em;
    border-radius: 4px;
  }
  .heroes li.selected:hover {
    background-color: #BBD8DC !important;
    color: white;
  }
  .heroes li:hover {
    color: #607D8B;
    background-color: #DDD;
    left: .1em;
  }
  .heroes .text {
    position: relative;
    top: -3px;
  }
  .heroes .badge {
    display: inline-block;
    font-size: small;
    color: white;
    padding: 0.8em 0.7em 0 0.7em;
    background-color: #607D8B;
    line-height: 1em;
    position: relative;
    left: -1px;
    top: -4px;
    height: 1.8em;
    margin-right: .8em;
    border-radius: 4px 0 0 4px;
  }
`]

})

export class HeroesComponent implements OnInit {
  ngOnInit(): void {
    this.getHeroes();
  }

  title = "Heroes";
  persons: Person[];
  selectedHero: Person;

  constructor(private personService: PersonService) {
  }

  onSelect(hero: Person): void {
    this.selectedHero = hero;
  };

  getHeroes(): void {
    this.personService.getHeroes().then(heroes => this.persons = heroes);
  }
}
