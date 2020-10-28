import {Component, Input, OnInit} from '@angular/core';
import {IProject, ProjectModel, TProject, TService} from "../../models/models";
import {environment} from "../../../environments/environment";
import {map, mergeMap} from "rxjs/operators";
import {Apollo} from "apollo-angular";
import {ActivatedRoute} from "@angular/router";
import {scaleFadeIn800ms} from "../../components/animations/scale-fade-in.animation";

@Component({
    selector: 'app-works-details',
    templateUrl: './works-details.component.html',
    styleUrls: ['./works-details.component.scss'],
    animations: [
        scaleFadeIn800ms
    ]
})
export class WorksDetailsComponent implements OnInit {

    project: IProject;
    serverPath = environment.apiUrl;
    isLoading: boolean;
    query = ProjectModel;

    constructor(private apollo: Apollo,
                private route: ActivatedRoute) {
    }

    ngOnInit(): void {
        this.isLoading = true;
        const routeChange$ = this.route.params;
        const onLoadData$ = routeChange$.pipe(
            mergeMap((value: { id: number }) => {
                return this.apollo.watchQuery<TProject>({
                    query: this.query,
                    variables: {
                        id: "projects/" + value.id
                    }
                }).valueChanges.pipe(
                    map(({data, loading, errors}) => {
                        this.project = data.project;
                        console.log(data.project);
                        this.isLoading = loading;
                    }));
            })
        );

        onLoadData$.subscribe();
    }

}
