import {Component, Input, OnInit} from '@angular/core';
import {IProject} from "../../models/models";
import {BASE_PATH} from "../../../environments/environment";

@Component({
  selector: 'app-project-item',
  templateUrl: './project-item.component.html',
  styleUrls: ['./project-item.component.scss']
})
export class ProjectItemComponent implements OnInit {

    @Input()projects: IProject[];

    serverPath = BASE_PATH

  constructor() { }

  ngOnInit(): void {
  }

}
