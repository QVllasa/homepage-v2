import {Component, Input, OnInit} from '@angular/core';
import {IExperience} from "../../models/models";

@Component({
    selector: 'app-experience-item',
    templateUrl: './experience-item.component.html',
    styleUrls: ['./experience-item.component.scss']
})
export class ExperienceItemComponent implements OnInit {

    experience: IExperience;
    @Input() experiences: IExperience[];

    constructor() { }

    ngOnInit(): void {
    }

}
