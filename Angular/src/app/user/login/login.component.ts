import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {UserService} from "../user.service";
import {User} from "app/user/user.model";
import {TimerObservable} from "rxjs/observable/TimerObservable";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html'
})
export class LoginComponent implements OnInit {
    token: User;
    model: any = {};
    loading: boolean = false;
    exists: boolean = false;

    constructor(private userService: UserService, private router: Router) {
        this.token = JSON.parse(localStorage.getItem('token'));
    }

    ngOnInit() {
    }

    login() {
      this.loading = true;
      this.userService.login(this.model.username, this.model.password)
        .subscribe(
          data => {
            let timer = TimerObservable.create(1000, 500);
              timer.subscribe(t => {
                location.reload();
                this.router.navigate(['']);
              });
          }
        );
    }
}
