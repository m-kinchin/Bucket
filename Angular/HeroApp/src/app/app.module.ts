import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }   from '@angular/forms';

import { AppComponent }  from './components/app.component';
import { HeroDetailsComponent }  from './components/hero-details.component';

@NgModule({
  imports:      [
    BrowserModule,
    FormsModule
  ],
  declarations: [
    AppComponent,
    HeroDetailsComponent
  ],
  bootstrap:    [
    AppComponent
  ]
})
export class AppModule { }
