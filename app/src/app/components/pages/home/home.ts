import {Component, OnDestroy, OnInit} from '@angular/core';
import {Apollo} from "apollo-angular";
import {Subscription} from "rxjs";
import {IAboutMe, IExperience, IMainPage, ISkill, MainPage} from "../../../models/main-page";
import {skills} from "../../../../static/data";


declare let $: any;


@Component({
    selector: 'app-home',
    templateUrl: './home.html',
    styleUrls: ['./home.scss']
})
export class Home implements OnInit {

    isLoading: boolean;
    query = MainPage;


    aboutMe: IAboutMe;

    experience: IExperience;

    companies: { path: string, link: string, class?: string[] }[] = [];
    icons: { path: string, link: string }[] = [];
    skills = skills;
    private querySubscription: Subscription;


    constructor(private apollo: Apollo) {
    }

    ngOnInit() {
        this.isLoading = true;
        this.querySubscription = this.apollo.watchQuery<IMainPage>({query: this.query}).valueChanges
            .subscribe(({data, error, loading}) => {
                this.aboutMe = data.aboutMe;
                this.isLoading = loading;
            });
    }

}
