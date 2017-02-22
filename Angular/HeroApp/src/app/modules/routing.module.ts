import {NgModule}             from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {DashboardComponent}   from '../components/dashboard.component';
import {HeroesComponent}      from '../components/heroes.component';
import {BadGuysComponent}      from '../components/bad-guys.component';
import {PersonDetailsComponent}  from '../components/person-details.component';

const routes: Routes = [
  {path: 'heroes', component: HeroesComponent},
  {path: 'dashboard', component: DashboardComponent},
  {path: '', redirectTo: '/dashboard', pathMatch: 'full'},
  {path: 'bad_guys', component: BadGuysComponent},
  {path: 'detail/:id', component: PersonDetailsComponent}
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class RoutingModule {
}
