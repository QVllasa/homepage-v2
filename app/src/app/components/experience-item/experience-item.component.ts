import {Component, Input, OnInit} from '@angular/core';
import {IExperience} from "../../models/models";
import {fadeInRight800ms} from "../animations/fade-in-right.animation";
import {fadeInLeft800ms} from "../animations/fade-in-left.animation";
import {fadeInUp800ms} from "../animations/fade-in-up.animation";

@Component({
    selector: 'app-experience-item',
    templateUrl: './experience-item.component.html',
    styleUrls: ['./experience-item.component.scss'],
    animations: [
        fadeInRight800ms,
        fadeInLeft800ms,
        fadeInUp800ms
    ]
})
export class ExperienceItemComponent implements OnInit {

    experience: IExperience;
    @Input() experiences: IExperience[];

    constructor() { }

    ngOnInit(): void {
    }

    isEven(value) {
        return value % 2 == 0;
    }

}
