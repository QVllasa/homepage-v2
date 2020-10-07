import {Component, Input, OnInit} from '@angular/core';
import {ISkill} from "../../models/models";
import {stagger40ms} from "../animations/stagger.animation";
import {fadeInRight800ms} from "../animations/fade-in-right.animation";
import {fadeInLeft800ms} from "../animations/fade-in-left.animation";

@Component({
  selector: 'app-skills',
  templateUrl: './skills.component.html',
  styleUrls: ['./skills.component.scss'],
    animations: [
        fadeInRight800ms,
        fadeInLeft800ms
    ]
})
export class SkillsComponent implements OnInit {

    @Input()skills: ISkill[];

  constructor() { }

  ngOnInit(): void {
  }

    isEven(value) {
        return value % 2 == 0;
    }

}
