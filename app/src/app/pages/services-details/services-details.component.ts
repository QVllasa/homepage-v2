import {Component, OnInit} from '@angular/core';
import {Apollo} from "apollo-angular";
import {IServiceSection, ServiceModel, TService} from "../../models/models";
import {ActivatedRoute} from "@angular/router";
import {map, mergeMap} from "rxjs/operators";
import {environment} from "../../../environments/environment";
import {scaleFadeIn800ms} from "../../components/animations/scale-fade-in.animation";
import {fadeInLeft800ms} from "../../components/animations/fade-in-left.animation";
import {fadeInRight800ms} from "../../components/animations/fade-in-right.animation";
import {scaleIn400ms} from "../../components/animations/scale-in.animation";


@Component({
    selector: 'app-services-details',
    templateUrl: './services-details.component.html',
    styleUrls: ['./services-details.component.scss'],
    animations: [
        scaleFadeIn800ms,
        fadeInLeft800ms,
        fadeInRight800ms,
        scaleIn400ms
    ]
})
export class ServicesDetailsComponent implements OnInit {

    service: TService;
    sections: IServiceSection[] = [];
    serverPath = environment.apiUrl;
    isLoading: boolean;
    query = ServiceModel;


    constructor(private apollo: Apollo,
                private route: ActivatedRoute) {
    }

    isEven(value) {
        return value % 2 == 0;
    }

    ngOnInit(): void {
        this.isLoading = true;
        const routeChange$ = this.route.params;
        const onLoadData$ = routeChange$.pipe(
            mergeMap((value: { id: number }) => {
                return this.apollo.watchQuery<TService>({
                    query: this.query,
                    variables: {
                        id: "services/" + value.id
                    }
                }).valueChanges.pipe(
                    map(({data, loading, errors}) => {
                        this.service = data;
                        console.log(data);
                        this.sections = [];
                        for (let section of data.service.serviceSections.edges) {
                            console.log(section.node)
                            this.sections.push(section.node);
                        }
                        this.isLoading = loading;

                    }));
            })
        );

        onLoadData$.subscribe();
    }


}
