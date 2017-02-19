import { Injectable } from '@angular/core';
import { Person } from '../models/person';
import { HEROES } from '../mocks/heroes-mock';

@Injectable()
export class HeroService {
  getHeroes(): Promise<Person[]> {
    return Promise.resolve(HEROES);
  };
  getHeroesSlowly(): Promise<Person[]> {
    return new Promise(resolve => {
      // Simulate server latency with 2 second delay
      setTimeout(() => resolve(this.getHeroes()), 2000);
    });
  }
}
