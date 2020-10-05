import {Component, Input, OnInit} from '@angular/core';
import {ISkill} from "../../models/models";

@Component({
  selector: 'app-skills',
  templateUrl: './skills.component.html',
  styleUrls: ['./skills.component.scss']
})
export class SkillsComponent implements OnInit {

    @Input()skills: ISkill[];

  constructor() { }

  ngOnInit(): void {
  }

}
