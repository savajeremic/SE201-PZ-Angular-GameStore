import {Component, Directive} from '@angular/core';
import {User} from "../../user/user.model";

@Component({
  selector: 'AboutUs',
  templateUrl: './aboutus.component.html'
})

export class AboutUsComponent{
  token: User;

  constructor() {
    this.token = JSON.parse(localStorage.getItem('token'));
  }
}
