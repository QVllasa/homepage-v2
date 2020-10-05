import {Component, OnInit} from '@angular/core';
import {Apollo} from "apollo-angular";
import {IService, IServiceSection, ServiceModel, TService} from "../../models/models";
import {ActivatedRoute} from "@angular/router";
import {map, mergeMap} from "rxjs/operators";
import {BASE_PATH} from "../../../environments/environment";


@Component({
    selector: 'app-services-details',
    templateUrl: './services-details.component.html',
    styleUrls: ['./services-details.component.scss']
})
export class ServicesDetailsComponent implements OnInit {

    service: TService;
    sections: IServiceSection[] = [];
    serverPath = BASE_PATH;
    query = ServiceModel;
    isLoading: boolean;


    constructor(private apollo: Apollo,
                private route: ActivatedRoute) {
    }

    isEven(value) {
        if (value % 2 == 0){
            return true;
        }else {
            return false;
        }
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
