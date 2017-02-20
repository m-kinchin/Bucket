import {Injectable} from '@angular/core';
import {Person} from '../models/person';
import {HEROES} from '../mocks/heroes-mock';
import {BADGUYS} from '../mocks/bad-guys-mock';

@Injectable()
export class PersonService {
  getHeroes(): Promise<Person[]> {
    return Promise.resolve(HEROES);
  };

  getHeroesSlowly(): Promise<Person[]> {
    return new Promise(resolve => {
      // Simulate server latency with 2 second delay
      setTimeout(() => resolve(this.getHeroes()), 2000);
    });
  };

  getHero(id: number): Promise<Person> {
    return this.getHeroes()
      .then(heroes => heroes.find(hero => hero.id === id));
  };

  getBadGuys(): Promise<Person[]> {
    return Promise.resolve(BADGUYS);
  };

  getBadGuysSlowly(): Promise<Person[]> {
    return new Promise(resolve => {
      // Simulate server latency with 2 second delay
      setTimeout(() => resolve(this.getBadGuys()), 2000);
    });
  };

  getBadGuy(id: number): Promise<Person> {
    return this.getBadGuys()
      .then(heroes => heroes.find(hero => hero.id === id));
  };

  getPerson(id: number): Promise<Person> {
    if(id > 100) {
      return this.getBadGuy(id);
    }
     else {
      return this.getHero(id);
    }
  };
}
