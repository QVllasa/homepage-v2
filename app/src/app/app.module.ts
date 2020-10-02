import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PreloaderComponent } from './components/layouts/preloader/preloader.component';
import { Home } from './components/pages/home/home';
import { BlogDetailsComponent } from './components/pages/blog-details/blog-details.component';
import { WorksDetailsComponent } from './components/pages/works-details/works-details.component';
import { ServicesDetailsComponent } from './components/pages/services-details/services-details.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatTooltipModule} from "@angular/material/tooltip";
import {IvyCarouselModule} from "angular-responsive-carousel";
import {MatGridListModule} from "@angular/material/grid-list";
import { FooterComponent } from './components/pages/footer/footer.component';
import { SidenavComponent } from './components/pages/sidenav/sidenav.component';
import { NotFoundComponent } from './components/pages/not-found/not-found.component';


@NgModule({
  declarations: [
    AppComponent,
    PreloaderComponent,
    Home,
    BlogDetailsComponent,
    WorksDetailsComponent,
    ServicesDetailsComponent,
    FooterComponent,
    SidenavComponent,
    NotFoundComponent
  ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        MatTooltipModule,
        IvyCarouselModule,
        MatGridListModule
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
