import { Component, OnInit } from '@angular/core';
import {fadeInRight800ms} from "../animations/fade-in-right.animation";
import {fadeInLeft800ms} from "../animations/fade-in-left.animation";

@Component({
  selector: 'app-education-item',
  templateUrl: './education-item.component.html',
  styleUrls: ['./education-item.component.scss'],
    animations: [
        fadeInRight800ms,
        fadeInLeft800ms
    ]
})
export class EducationItemComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

}
