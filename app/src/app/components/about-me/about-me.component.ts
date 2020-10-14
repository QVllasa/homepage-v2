import {Component, Input, OnInit} from '@angular/core';
import {OwlOptions} from "ngx-owl-carousel-o";
import {IAboutMe, IExperience, IProfileImage, ISkill} from "../../models/models";
import {environment} from "../../../environments/environment";
import {fadeInUp800ms} from "../animations/fade-in-up.animation";

@Component({
  selector: 'app-about-me',
  templateUrl: './about-me.component.html',
  styleUrls: ['./about-me.component.scss'],
    animations: [
        fadeInUp800ms
    ]
})
export class AboutMeComponent implements OnInit {

    @Input() aboutMe: IAboutMe;
    @Input()skills: ISkill[];
    @Input() experiences: IExperience[];
    @Input() profileImages: IProfileImage[];

    activeTab: 'top-skills' | 'experience' | 'education';
    serverPath = environment.apiUrl;

  constructor() { }

  ngOnInit(): void {
      this.activeTab = 'top-skills';
  }

    onToggleTabs(tab) {
        this.activeTab = tab;
    }

    errorHandler(event) {
        event.target.src = this.serverPath+this.profileImages[1].contentUrl;
    }

}
