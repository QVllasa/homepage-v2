import {Component, Input, OnInit} from '@angular/core';
import {IProject} from "../../models/models";
import {environment} from "../../../environments/environment";

@Component({
  selector: 'app-project-item',
  templateUrl: './project-item.component.html',
  styleUrls: ['./project-item.component.scss']
})
export class ProjectItemComponent implements OnInit {

    @Input()projects: IProject[];

    serverPath = environment.apiUrl

  constructor() { }

  ngOnInit(): void {
  }

}
