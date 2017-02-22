import {NgModule}      from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule}   from '@angular/forms';
import {RouterModule}   from '@angular/router';

import {StartupComponent}  from '../components/startup.component';
import {PersonDetailsComponent}  from '../components/person-details.component';
import {HeroesComponent} from "../components/heroes.component";
import {BadGuysComponent} from "../components/bad-guys.component";
import {DashboardComponent} from "../components/dashboard.component";
import {PersonService} from "../services/person.service";
import {RoutingModule} from "./routing.module";

@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    RoutingModule
  ],
  declarations: [
    StartupComponent,
    PersonDetailsComponent,
    HeroesComponent,
    DashboardComponent,
    BadGuysComponent
  ],
  bootstrap: [
    StartupComponent
  ],
  providers: [
    PersonService
  ],
})

export class AppModule {
}
