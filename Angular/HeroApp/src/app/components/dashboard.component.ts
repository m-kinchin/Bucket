import {Component, OnInit} from '@angular/core';
import { Person } from '../models/person';
import { HeroService } from '../services/hero.service';
import { BadGuyService } from '../services/bad-guy.service';

@Component({
  moduleId: module.id,
  selector: 'dashboard',
  templateUrl: '../templates/dashboard.component.html',
})

export class DashboardComponent implements OnInit{
  ngOnInit(): void {
    this.heroService.getHeroes().then(heroes => this.heroes = heroes.slice(1,5));
    this.badGuyService.getBadGuys().then(badGuys => this.badGuys = badGuys.slice(1,5));
  }

  heroes: Person[] = [];
  badGuys: Person[] = [];

  constructor(private heroService: HeroService, private badGuyService: BadGuyService){}


}
