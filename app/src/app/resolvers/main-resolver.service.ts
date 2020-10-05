import { Injectable } from '@angular/core';
import {ActivatedRouteSnapshot, Resolve, RouterStateSnapshot} from "@angular/router";
import {IMainPage, MainPage} from "../models/main-page";
import {Apollo} from "apollo-angular";

@Injectable({
  providedIn: 'root'
})
export class MainResolverService implements Resolve<any> {



  constructor(private apollo: Apollo) { }

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> | Promise<any> | any {
        return
    }
}
