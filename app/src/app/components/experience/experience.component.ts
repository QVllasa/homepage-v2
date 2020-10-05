import {Component, Input, OnInit} from '@angular/core';
import {IExperience} from "../../models/models";

@Component({
  selector: 'app-experience',
  templateUrl: './experience.component.html',
  styleUrls: ['./experience.component.scss']
})
export class ExperienceComponent implements OnInit {

    experience: IExperience;
    @Input() experiences: IExperience[];

  constructor() { }

  ngOnInit(): void {
  }

}
