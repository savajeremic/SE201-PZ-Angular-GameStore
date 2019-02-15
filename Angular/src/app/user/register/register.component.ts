import {Component} from "@angular/core";
import {User} from "../user.model";
import {UserService} from "../user.service";
import {TimerObservable} from "rxjs/observable/TimerObservable";
import {Router} from "@angular/router";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
})

export class RegisterComponent{
  token: User;
  model: any = {};

  constructor(private userService: UserService, private router: Router) {
    this.token = JSON.parse(localStorage.getItem('token'));
  }

  onRegister() {
    this.userService.register(this.model.username,
    this.model.password,
    this.model.email)
    .subscribe(
      data => {
        let timer = TimerObservable.create(1000, 500);
          timer.subscribe(t => {
            location.reload();
            this.router.navigate(['']);
          });
      });
    }
}
