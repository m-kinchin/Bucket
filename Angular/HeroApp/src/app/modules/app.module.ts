import {NgModule}      from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule}   from '@angular/forms';
import {RouterModule}   from '@angular/router';

import {StartupComponent}  from '../components/startup.component';
import {PersonDetailsComponent}  from '../components/person-details.component';
import {PersonsComponent} from "../components/persons.component";
import {DashboardComponent} from "../components/dashboard.component";
import {PersonService} from "../services/person.service";
import {RoutingModule} from "./routing.module";
import {CapitalizePipe} from "../pipes/capitalize.pipe";

@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    RoutingModule
  ],
  declarations: [
    StartupComponent,
    PersonDetailsComponent,
    PersonsComponent,
    DashboardComponent,
    CapitalizePipe
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
