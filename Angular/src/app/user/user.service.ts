import {Injectable} from "@angular/core";
import {Http, Response} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {User} from "./user.model";
import {SharedService} from "../shared/shared.service";
import {Router} from '@angular/router';

@Injectable()
export class UserService {
  private url = 'http://127.0.0.1/gamedream/';

  constructor(private http: Http, private sharedService: SharedService, private router: Router) {
  }

  getUser(): Observable<User> {
        let headers = this.sharedService.getHeaders();
        return this.http.get(this.url + 'getprofile.php', {headers: headers})
            .map((response: Response) => <User> response.json());
    }

  register(username: string, password: string, email: string) { /*, name: string, surname: string, avatar: string, birth_date: string, country: string*/
    let data = "username=" + username + "&password=" + password + "&email=" + email; /*+
    "&name=" + name + "&surname=" + surname + "&avatar=" + avatar +
    "&birth_date=" + birth_date + "&country=" + country*/
    let headers = this.sharedService.getHeaders();
    return this.http.post(this.url + 'register.php', data, {headers: headers})
      .map((response: Response) => {
        let user = response.json();
        if (user && user.token) {
          localStorage.setItem('token', JSON.stringify(user.token));
        }
      });
  }

  login(username: string, password: string) {
    let data = "username=" + username + "&password=" + password;
    let headers = this.sharedService.getHeaders();
    return this.http.post(this.url + 'login.php', data, {headers: headers})
      .map((response: Response) => {
        let user = response.json();
        if (user && user.token) {
          localStorage.setItem('token', JSON.stringify(user.token));
        }
      });
  }

  updateProfile(avatar: string, birth_date: string, country: string) {
    let data = "avatar=" + avatar +
    "&birth_date=" + birth_date +
    "&country=" + country;
    let headers = this.sharedService.getHeaders();
    this.http.post(this.url + 'updateprofile.php', data, {headers: headers})
        .map(res => res)
        .subscribe(data => data)
    }

  logout() {
    localStorage.removeItem('token');
    this.router.navigate(['./']);;
  }
}
