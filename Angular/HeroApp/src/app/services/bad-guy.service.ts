import { Injectable } from '@angular/core';
import { Person } from '../models/person';
import { BADGUYS } from '../mocks/bad-guys-mock';

@Injectable()
export class BadGuyService {
  getBadGuys(): Promise<Person[]> {
    return Promise.resolve(BADGUYS);
  };
  getBadGuysSlowly(): Promise<Person[]> {
    return new Promise(resolve => {
      // Simulate server latency with 2 second delay
      setTimeout(() => resolve(this.getBadGuys()), 2000);
    });
  }
}
