import {Component, Input, OnInit} from '@angular/core';
import {ISkill} from "../../../models/main-page";

@Component({
  selector: 'app-skill-item',
  templateUrl: './skill-item.component.html',
  styleUrls: ['./skill-item.component.scss']
})
export class SkillItemComponent implements OnInit {

    @Input() skill: ISkill;

  constructor() { }

  ngOnInit(): void {
  }

}
