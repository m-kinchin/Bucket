import {NgModule}             from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {DashboardComponent}   from '../components/dashboard.component';
import {PersonsComponent}      from '../components/persons.component';
import {PersonDetailsComponent}  from '../components/person-details.component';

const routes: Routes = [
  {path: 'dashboard', component: DashboardComponent},
  {path: '', redirectTo: '/dashboard', pathMatch: 'full'},
  {path: 'detail/:id', component: PersonDetailsComponent},
  {path: 'persons/:personsType', component: PersonsComponent}
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class RoutingModule {
}
