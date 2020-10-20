import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {HomeComponent} from './pages/home/home.component';
import {ServicesDetailsComponent} from './pages/services-details/services-details.component';
import {WorksDetailsComponent} from './pages/works-details/works-details.component';
import {BlogDetailsComponent} from './pages/blog-details/blog-details.component';
import {NotFoundComponent} from "./pages/not-found/not-found.component";
import {LegalComponent} from "./pages/legal/legal.component";
import {PrivacyComponent} from "./pages/privacy/privacy.component";


const routes: Routes = [
    {path: 'home', component: HomeComponent},
    {path: 'services-details/:id', component: ServicesDetailsComponent},
    {path: 'works-details/:id', component: WorksDetailsComponent},
    {path: 'blog-details/:id', component: BlogDetailsComponent},
    {path: 'legal', component: LegalComponent},
    {path: 'privacy', component: PrivacyComponent},
    {
        path: '', redirectTo: 'home', pathMatch: 'full'
    },
    {path: '**', component: NotFoundComponent},
];

@NgModule({
    imports: [RouterModule.forRoot(routes, {
        scrollPositionRestoration: 'enabled', // or 'top'
        anchorScrolling: 'enabled',
    })],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
