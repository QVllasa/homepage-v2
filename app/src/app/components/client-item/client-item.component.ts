import {Component, Input, OnInit} from '@angular/core';
import {IClient} from "../../models/models";
import {BASE_PATH} from "../../../environments/environment";

@Component({
  selector: 'app-client-item',
  templateUrl: './client-item.component.html',
  styleUrls: ['./client-item.component.scss']
})
export class ClientItemComponent implements OnInit {

    @Input()clients: IClient[];

    serverPath = BASE_PATH

  constructor() { }

  ngOnInit(): void {
  }

}
