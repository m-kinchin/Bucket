import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { Hero } from '../models/hero';
import { HeroDetailsComponent } from './hero-details.component';
import { HeroService } from '../services/hero.service';

@Component({
  selector: 'my-app',
  providers: [HeroService],
  template: `
  <h1>{{title}}</h1>
  <h2>My Heroes</h2>
  <ul class="heroes">
    <li 
      (click)="onSelect(hero)" 
      [class.selected-odd]="hero === selectedHero && hero.id % 2 != 0"
      [class.selected-even]="hero === selectedHero && hero.id % 2 == 0"
      *ngFor="let hero of heroes">
      <span class="badge">{{hero.id}}</span> {{hero.name}}
    </li>
  </ul>
  <hero-details [hero]="selectedHero"></hero-details>
`,
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

export class AppComponent  implements OnInit {
  ngOnInit(): void {
    this.getHeroes();
  }
  title = 'Tour of Heroes';
  heroes : Hero[];
  selectedHero: Hero;
  constructor(private heroService: HeroService) { }
  onSelect(hero: Hero): void {
    this.selectedHero = hero;
  };
  getHeroes(): void {
    this.heroService.getHeroesSlowly().then(heroes => this.heroes = heroes);
  }
 }
