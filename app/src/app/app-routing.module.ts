import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {HomeComponent} from './pages/home/home.component';
import {ServicesDetailsComponent} from './pages/services-details/services-details.component';
import {WorksDetailsComponent} from './pages/works-details/works-details.component';
import {BlogDetailsComponent} from './pages/blog-details/blog-details.component';
import {NotFoundComponent} from "./pages/not-found/not-found.component";


const routes: Routes = [
    {
        path: '', redirectTo: 'home', pathMatch: 'full'
    },
    {path: 'home', component: HomeComponent},
    {path: 'services-details/:id', component: ServicesDetailsComponent},
    {path: 'works-details/:id', component: WorksDetailsComponent},
    {path: 'blog-details/:id', component: BlogDetailsComponent},
    {path: '**', component: NotFoundComponent},
];

@NgModule({
    imports: [RouterModule.forRoot(routes, {anchorScrolling: 'enabled'})],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
