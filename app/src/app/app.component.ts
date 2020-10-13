import { Component, OnInit } from '@angular/core';
import {Router, NavigationStart, NavigationCancel, NavigationEnd, RouterEvent} from '@angular/router';
import { Location, LocationStrategy, PathLocationStrategy } from '@angular/common';
import { filter } from 'rxjs/operators';
declare let $: any;

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss'],
    providers: [
        Location, {
            provide: LocationStrategy,
            useClass: PathLocationStrategy
        }
    ]
})
export class AppComponent implements OnInit {
    location: any;
    routerSubscription: any;

    state: boolean;

    constructor(private router: Router) {}

    ngOnInit(){
    }

    getState(event: boolean){
        this.state = event;
    }


}
